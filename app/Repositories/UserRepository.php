<?php

namespace App\Repositories;

use App\Helpers\FileHelper;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Support\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class UserRepository
{
    protected string $basePath = 'uploads/avatars';

    /**
     * List users with pagination, filters, sorting.
     */
    public function index(Request $request)
    {
        $searchable = ['name', 'email', 'phone', 'role'];
        $sortable = ['name', 'email', 'phone', 'role', 'status', 'created_at'];

        $searchTerm = $request->input('searchTerm');
        $sortByInput = $request->input('sortBy');
        $sortOrderInput = strtolower($request->input('sortOrder', 'desc'));
        $perPage = $request->input('perPage');

        $sortOrder = in_array($sortOrderInput, ['asc', 'desc']) ? $sortOrderInput : 'desc';
        $sortBy = in_array($sortByInput, $sortable) ? $sortByInput : 'id';

        $query = User::select(
            'users.id',
            'name',
            'email',
            'phone',
            'role',
            'status',
            'created_at',
        )
            ->where('users.id', '<>', Auth::id());

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm, $searchable) {
                foreach ($searchable as $column) {
                    $q->orWhere($column, 'LIKE', '%' . strtolower($searchTerm) . '%');
                }
            });
        }

        $query->orderBy($sortBy, $sortOrder);

        return $perPage && (int) $perPage > 0
            ? $query->paginate((int) $perPage)
            : $query->get();
    }

    /**
     * Requirements to create/update user
     */
    public function requirements()
    {

        $formattedRoles = collect(Role::all())->map(function ($role) {
            return [
                'code' => $role['code'],
                'name' => $role['name'][app()->getLocale()] ?? $role['name']['fr'],
            ];
        });

        return [
            'roles'  => $formattedRoles,
        ];
    }


    /**
     * Store a new user.
     */
    public function store(UserRequest $request)
    {
        $avatarName = null;
        DB::beginTransaction();
        try {

            $userData = $request->only([
                'name',
                'email',
                'phone',
                'role',
                'password'
            ]);

            if (!empty($userData['password'])) {
                $userData['password'] = Hash::make($userData['password']);
            }

            $userData['created_by'] = Auth::user()?->uuid;
            $userData['updated_by'] = Auth::user()?->uuid;
            $userData['terms_accepted_at'] = now();
            $userData['signup_method'] = "email";
            $userData['status'] = filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN);

            $user = User::create($userData);

            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                $avatarName = FileHelper::upload($avatarFile, $this->basePath);
                $user->update(['avatar' => $avatarName]);
            }

            DB::commit();
            return (new UserResource($user))->additional([
                'mode' => $request->input('mode', 'view')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            if (!empty($newAvatarName)) {
                FileHelper::delete("{$this->basePath}/{$newAvatarName}");
            }
            throw $e;
        }
    }

    /**
     * Show a specific user.
     */
    public function show(User $user)
    {
        return ['user' => new UserResource($user)];
    }

    /**
     * Update a user.
     */
    public function update(UserRequest $request, User $user)
    {
        $oldAvatarName = $user->avatar;
        $newAvatarName = null;

        DB::beginTransaction();
        try {

            $userData = $request->only([
                'name',
                'email',
                'phone',
                'role',
            ]);

            $userData['status'] = filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN);
            $userData['updated_by'] = Auth::user()?->uuid;
            if (!$user->terms_accepted_at) $userData['terms_accepted_at'] = now();

            if ($user->signup_method === 'google' || $user->google_id) {
                unset($userData['email']);
            }

            if ($request->filled('password') && $user->signup_method !== 'google') {
                $userData['password'] = Hash::make($userData['password']);
            }

            if ($request->boolean('delete_avatar') && $oldAvatarName) {
                FileHelper::delete("{$this->basePath}/{$oldAvatarName}");
                $userData['avatar'] = null;
            }

            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                $newAvatarName = FileHelper::upload($avatarFile, $this->basePath);
                $userData['avatar'] = $newAvatarName;

                if ($oldAvatarName && $oldAvatarName !== $newAvatarName) {
                    FileHelper::delete("{$this->basePath}/{$oldAvatarName}");
                }
            }

            $user->update($userData);

            DB::commit();
            return (new UserResource($user))->additional([
                'mode' => $request->input('mode', 'edit')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            if (!empty($newAvatarName)) {
                FileHelper::delete("{$this->basePath}/{$newAvatarName}");
            }
            throw $e;
        }
    }

    /**
     * Delete users.
     */
    public function destroy(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids) || !is_array($ids)) {
            throw new \InvalidArgumentException(__('app/common.destroy.invalid_ids'));
        }

        DB::beginTransaction();
        try {

            $users = User::whereIn('id', $ids)->get();

            if ($users->isEmpty()) {
                throw new RuntimeException(__('app/common.destroy.no_items_deleted'));
            }

            $avatars = $users
                ->pluck('avatar')
                ->filter()
                ->map(fn($avatar) => "{$this->basePath}/{$avatar}")
                ->toArray();

            User::whereIn('id', $users->pluck('id'))->delete();

            DB::commit();

            foreach ($avatars as $path) {
                FileHelper::delete($path);
            }
        } catch (RuntimeException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();

            if ($e->getCode() === "23000") {
                throw new \Exception(__('app/common.repository.foreignKey'));
            }

            throw new \Exception(__('app/common.repository.error'));
        }
    }
}
