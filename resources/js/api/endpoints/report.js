import base from "./urlBase";

export default {
    getAll: `${base.API}/reports?mode=list`,
    requirements: `${base.API}/reports/requirements`,
    find: (id) => `${base.API}/reports/${id}`,
    create: `${base.API}/reports`,
    update: (id) => `${base.API}/reports/${id}`,
    destroy: `${base.API}/reports/destroy`,
};
