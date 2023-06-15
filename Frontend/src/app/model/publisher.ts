import {Book} from "./book";
import {DisplayNames} from "../utils/displayNames";

export interface Publisher {
  id: number;
  publisherNumber: number;
  name: string;
  books: Book[];
}

export const PUBLISHER_DISPLAY_NAMES: DisplayNames<Publisher> = {
  object: "Verlag",
  id: "ID",
  publisherNumber: "VNR",
  name: "Name",
  books: "Bücher",
}
