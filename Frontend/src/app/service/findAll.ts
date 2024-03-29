import { Observable } from "rxjs";

export interface FindAll<T> {
    delete(id: number): Observable<T>;
    findAll(): Observable<T[]>;
    update(id: number, data: T): Observable<T>;
}
