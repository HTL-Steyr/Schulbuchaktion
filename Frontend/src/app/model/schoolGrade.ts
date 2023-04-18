import {Book, BOOK_DISPLAY_NAMES} from "./book";
import {DisplayNames} from "../utils/displayNames";

export interface SchoolGrade {
  id: number;
  grade: number;
  book: Book;
}

export const SCHOOL_GRADE_DISPLAY_NAMES: DisplayNames<SchoolGrade> = {
  object: "Jahrgang",
  id: "ID",
  grade: "Jahrgang",
  book: BOOK_DISPLAY_NAMES.object,
}
