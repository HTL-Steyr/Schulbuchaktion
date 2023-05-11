export type DisplayNames<T> = {
  [P in keyof T]: string;
} & {object: string};


interface Value {
  valueName: string;
  displayName: string;
}

export function displayNamesToList(displayNames: DisplayNames<any>): Value[] {
  return Object.entries(displayNames).map(([key, value]) => {
    return {valueName: key, displayName: value};
  });
}
