export class SubjectClassService{

    constructor(){
        this.classSubjects = [];
        this.subjects = [];
        this.classes = [];
    }

    getAllSubjects(){
         var self = this;
        axios.get('classsubjects').then(function(result){
              self.classSubjects = result.data.classSubjects;
              self.subjects = result.data.subjects;
              self.classes = result.data.classes;
              console.log(self);
        });
    }

    getClassSubjects(class_id){

    }
}
