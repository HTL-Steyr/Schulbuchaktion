import {SchoolClass} from "./schoolclass";
import {User} from "./user";
import {DisplayNames} from "../utils/displayNames";

export interface Department {
  id: number;
  name: string;
  budget: number;
  usedBudget: number;
  headOfDepartment: User;
  schoolClasses: SchoolClass[];
}

export const DEPARTMENT_DISPLAY_NAMES: DisplayNames<Department> = {
  object: "Abteilung",
  id: "ID",
  name: "Name",
  budget: "Budget",
  usedBudget: "verwendetes Budget",
  headOfDepartment: "Vorstand",
  schoolClasses: "Klassen",
}
