import { Book } from "./book";

export interface Publisher {
    id: number;
    publisherNumber: number;
    name: string;
    books: Book[];
}
