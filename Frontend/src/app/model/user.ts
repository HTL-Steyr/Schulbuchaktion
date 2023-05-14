import {Role} from "./role";
import {DisplayNames} from "../utils/displayNames";

export interface User {
  id: number;
  shortName: string;
  firstName: string;
  lastName: string;
  email: string;
  token: string;
  password: string;
  role: Role;
}

export const USER_DISPLAY_NAMES: DisplayNames<User> = {
  object: "Benutzer",
  id: "ID",
  shortName: "Kürzel",
  firstName: "Vorname",
  lastName: "Nachname",
  email: "E-Mail",
  token: "Token",
  password: "Passwort",
  role: "Rolle",
}
