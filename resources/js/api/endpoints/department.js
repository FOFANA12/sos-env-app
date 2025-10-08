import base from './urlBase';

export default {
  getAll: `${base.API}/departments?mode=list`,
  requirements: `${base.API}/departments/requirements`,
  find: (id, mode = 'edit') => `${base.API}/departments/${id}?mode=${mode}`,
  create: `${base.API}/departments`,
  update: (id) => `${base.API}/departments/${id}`,
  destroy: `${base.API}/departments/destroy`,
};
