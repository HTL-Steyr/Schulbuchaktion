import {Book} from "./book";

export interface SchoolGrade {
  id: number;
  grade: number;
  bookId: Book;
}
