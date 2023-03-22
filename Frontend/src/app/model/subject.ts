import {Book} from "./book";

export interface Subject {
  id: number;
  name: string;
  shortName: string;
  headOfSubject: string;
  books: Book[];
}
