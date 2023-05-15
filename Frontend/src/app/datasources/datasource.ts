import CustomStore from "devextreme/data/custom_store";
import DataSource from "devextreme/data/data_source";
import { FindAll } from "../service/findAll";

export class Datasource<T extends FindAll<any>> extends DataSource {
    constructor(private service: T, options: any = {}) {
        super(Object.assign({
            store: new CustomStore(Object.assign({
                load: () => {
                    return this.service.findAll().toPromise();
                },
                remove: async (key: any) => {
                    return this.service.delete(key).toPromise();
                },
                update: (id: number, data: T) => { },
            }))
        }))
    }
}
