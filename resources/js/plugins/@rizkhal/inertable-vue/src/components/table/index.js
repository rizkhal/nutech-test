import Column from "./column.vue";
import Nullable from "./nullable.vue";
import Inertable from "./inertable.vue";
import Pagination from "./pagination.vue";

import { formatComponentName } from "../../utils/helpers";

export default {
  install(app) {
    app.component(formatComponentName(Column.__name), Column);
    app.component(formatComponentName(Nullable.__name), Nullable);
    app.component(formatComponentName(Pagination.__name), Pagination);

    app.component(Inertable.name, Inertable);
  },
};

export { Column, Nullable, Pagination, Inertable };
