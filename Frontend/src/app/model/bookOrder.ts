import {Book} from "./book";
import {SchoolClass} from "./schoolclass";

export interface BookOrder {
  id?: number;
  price?: number;
  count?: number;
  ebook?: boolean;
  ebookPlus?: boolean;
  schoolClassId?: SchoolClass;
  bookId?: Book;
  teacherCopy?: boolean;

}
