<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td style="color:#444;font-size:13px;line-height:1.6;text-align:center;">
            <p style="margin:0 0 6px 0;font-weight:500;">
                {{ __('app/mail.closing.greeting') }}
            </p>
            <p style="margin:0 0 4px 0;color:#222;font-weight:600;">
                {{ __('app/mail.closing.team', ['app' => config('app.name')]) }}
            </p>
            <p style="margin:0;font-size:12px;color:#777;">
                {{ __('app/mail.closing.initiative', ['org' => 'Lexème de la Perspective']) }}
            </p>
        </td>
    </tr>
</table>
