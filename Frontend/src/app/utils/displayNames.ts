export type DisplayNames<T> = {
  [P in keyof T]: string;
} & {object: string};
