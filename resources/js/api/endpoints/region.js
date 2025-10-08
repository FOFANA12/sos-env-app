import base from './urlBase';

export default {
  getAll: `${base.API}/regions?mode=list`,
  find: (id) => `${base.API}/regions/${id}`,
  create: `${base.API}/regions`,
  update: (id) => `${base.API}/regions/${id}`,
  destroy: `${base.API}/regions/destroy`,
};
