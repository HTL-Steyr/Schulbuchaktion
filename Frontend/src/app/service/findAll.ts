import { Observable } from "rxjs";

export interface FindAll<T> {
    findAll(): Observable<T[]>;
}
