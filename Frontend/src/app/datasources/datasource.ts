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
                remove: async (id: number) => {
                    console.log("delete");
                    return this.service.delete(id).toPromise();
                },
                update: (id: number, data: T) => { }
            }))
        }))
    }
}
