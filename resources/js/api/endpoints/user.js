import base from './urlBase';

export default {
  getAll: `${base.API}/users?mode=list`,
  requirements: `${base.API}/users/requirements`,
  find: (id, mode = 'edit') => `${base.API}/users/${id}?mode=${mode}`,
  create: `${base.API}/users`,
  update: (id) => `${base.API}/users/${id}`,
  destroy: `${base.API}/users/destroy`,
};
