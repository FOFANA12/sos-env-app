import base from './urlBase';

export default {
  login: `${base.API}/spa-auth/login`,
  logout: `${base.API}/spa-auth/logout`,
  forgotPassword: `${base.API}/password/forgot`,
  resetPassword: `${base.API}/password/reset`,
  register: `${base.API}/register`,
};
