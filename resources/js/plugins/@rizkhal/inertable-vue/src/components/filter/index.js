import Search from "./search.vue";
import Dropdown from "./dropdown.vue";
import InputSelect from "./input-select.vue";
import DropdownLink from "./dropdown-link.vue";

import { formatComponentName } from "../../utils/helpers";

export default {
  install(app) {
    app.component(formatComponentName(Search.__name), Search);
    app.component(formatComponentName(Dropdown.__name), Dropdown);
    app.component(formatComponentName(InputSelect.__name), InputSelect);
    app.component(formatComponentName(DropdownLink.__name), DropdownLink);
  },
};

export { Search, Dropdown, InputSelect, DropdownLink };
