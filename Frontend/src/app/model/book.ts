import {Subject} from "./subject";
import {BookOrder} from "./bookOrder";
import {Publisher} from "./publisher";
import {BookPrice} from "./bookPrice";
import {SchoolGrade} from "./schoolGrade";

export interface Book {
  id?: number;
  bookNumber?: number;
  title: string;
  shortTitle?: string;
  listType?: number;
  schoolForm?: number;
  info?: string;
  ebook?: boolean;
  ebookPlus?: boolean;
  subject?: Subject;
  publisher?: Publisher;
  bookOrders: BookOrder[];
  schoolGrade: SchoolGrade[];
  bookPrices: BookPrice[];
  mainBook?: Book;
  childBooks?: Book[];
}
