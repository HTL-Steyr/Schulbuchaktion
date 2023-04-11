import {Role} from "./role";

export interface User {
  id: number;
  shortName: string;
  firstName: string;
  lastName: string;
  email: string;
  token: string;
  password: string;
  roleId: Role;
}
