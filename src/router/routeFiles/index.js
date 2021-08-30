import { routes as Data } from "./Data";
import { routes as Auth } from "./Auth";
import { routes as Main } from "./Main";
import { routes as Product } from "./Product";
import { routes as Blog } from "./Blog";
export const routes = [...Data, ...Auth, ...Product, ...Blog, ...Main];
