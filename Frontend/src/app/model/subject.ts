import {Book} from "./book";
import {DisplayNames} from "../utils/displayNames";

export interface Subject {
  id: number;
  name: string;
  shortName: string;
  headOfSubject: string;
  books: Book[];
}

export const SUBJECT_DISPLAY_NAMES: DisplayNames<Subject> = {
  object: "Gegenstand",
  id: "ID",
  name: "Name",
  shortName: "Kurztitel",
  headOfSubject: "Fachverantwortliche:r",
  books: "Bücher",
}
