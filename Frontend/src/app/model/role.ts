import {DisplayNames} from "../utils/displayNames";
import {User} from "./user";

export interface Role {
  id: number;
  name: string;
  users: User[];
}

export const ROLE_DISPLAY_NAMES: DisplayNames<Role> = {
  object: "Rolle",
  id: "ID",
  name: "Name",
  users: "Benutzer",
}
