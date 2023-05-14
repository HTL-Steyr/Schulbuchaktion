import {Department, DEPARTMENT_DISPLAY_NAMES} from "./department";
import {BOOK_ORDER_DISPLAY_NAMES, BookOrder} from "./bookOrder";
import {DisplayNames} from "../utils/displayNames";

export interface SchoolClass {
  id: number;
  name: string;
  grade: number;
  studentAmount: number;
  repAmount: number;
  usedBudget: number;
  budget: number;
  year: number;
  schoolForm: number;
  department: Department;
  bookOrders: BookOrder[];
}

export const SCHOOL_CLASS_DISPLAY_NAMES: DisplayNames<SchoolClass> = {
  object: "Klasse",
  id: "ID",
  name: "Name",
  grade: "Jahrgang",
  studentAmount: "Anzahl Schüler",
  repAmount: "Anzahl Repetenten",
  usedBudget: "Verwendetes Budget",
  budget: "Budget",
  year: "Jahr",
  schoolForm: "Schulform",
  department: DEPARTMENT_DISPLAY_NAMES.object,
  bookOrders: BOOK_ORDER_DISPLAY_NAMES.object,
}
