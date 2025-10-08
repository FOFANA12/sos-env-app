import base from './urlBase';

export default {
  getAll: `${base.API}/neighborhoods?mode=list`,
  requirements: `${base.API}/neighborhoods/requirements`,
  find: (id, mode = 'edit') => `${base.API}/neighborhoods/${id}?mode=${mode}`,
  create: `${base.API}/neighborhoods`,
  update: (id) => `${base.API}/neighborhoods/${id}`,
  destroy: `${base.API}/neighborhoods/destroy`,
};
