import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { User } from "../model/user";
import { Observable } from "rxjs";

@Injectable({
    providedIn: 'root'
})
export class UserService {
    private _user?: User;

    public get user(): User | undefined {
        return this._user;
    }

    public set user(value: User | undefined) {
        if (!value) return;

        this._user = value;
    }

    constructor(private _http: HttpClient) { }

    public findAll(): Observable<User[]> {
        throw new Error("Method not implemented")
    }

    public findOneById(): Observable<User> {
        throw new Error("Method not implemented")
    }
}
