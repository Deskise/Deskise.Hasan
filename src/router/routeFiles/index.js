import { routes as Data } from "./noLogin/Data";
import { routes as Auth } from "./noLogin/Auth";
import { routes as Main } from "./noLogin/Main";
import { routes as Blog } from "./noLogin/Blog";

import { routes as Product } from "./needLogin/Product";
import { routes as Dashboard } from "./needLogin/Dashboard";

export const routes = [
  ...Data,
  ...Auth,
  ...Blog,
  ...Main,

  ...Product,
  ...Dashboard,
];
