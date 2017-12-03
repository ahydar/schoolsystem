export class Form{

    constructor(data){
        this.originalData = data;

        for(let field in data){
          this[field] = data[field];
        }

        this.errors = new Errors();
    }

    reset(){

      for(let field in this.originalData){
        this[field] = '';
      }

      this.errors.clear();
    }

    edit(data){
        for(let field in data){
          this[field] = data[field];
        }
    }

    data(){
        let data = Object.assign({},this);

        delete data.originalData;
        delete data.errors;

        return data;
    }

    submit(requestType,url){
          console.log('submitting');
          return new Promise((resolve,reject) => {

            axios[requestType](url,this.data())
              .then(response => {
                this.onSuccess(response.data);
                resolve(response.data);
              })
              .catch( error =>{
                  this.onFail(error);
                  reject(error);
              });
          });
    }


    onSuccess(response){
          console.log("Success");
          this.reset();
    }

    onFail(error){
        console.log("******Big Error********");
        console.log(error);
        this.errors.record(error.response.data.errors);
    }
}


export class Errors{

    constructor(){
      this.errors = {};
    }

    get(field){
      if(this.errors[field]){
        return this.errors[field][0];
      }
    }

    record(errors){
      this.errors = errors;
    }

    clear(field){
      if(field){
        delete this.errors[field];
        return;
      }

      this.errors = {};

    }

    any(){
      return Object.keys(this.errors).length > 0;
    }
}
