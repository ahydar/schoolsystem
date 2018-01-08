import VueRouter from 'vue-router';


let routes = [
  {
    path:'/',
    component:require('./views/Home')
  },

  {
    path:'/about',
    component:require('./views/About')
  },

  {
    path:'/accounts',
    component:require('./entrance/Accounts')
  },

  {
    path:'/grades',
    component:require('./entrance/Grades')
  },

  {
    path:'/classes',
    component:require('./entrance/Classes')
  },

  {
    path:'/subjects',
    component:require('./entrance/Subjects')
  },

  {
    path:'/classsubjects',
    component:require('./entrance/ClassSubjects')
  },

  {
    path:'/educators',
    component:require('./users/educators/ViewEducators')
  },

  {
    path:'/educator',
    name:'edu',
    component:require('./users/educators/Educator'),
    props:true
  },
  {
    path:'/educatorsubjects',
    name:'educatorsubjects',
    component:require('./users/educators/EducatorSubjects'),
    props:true
  },

  {
    path:'/learners',
    component:require('./users/learners/ViewLearners')
  },
  {
    path:'/learner',
    name:'learner',
    component:require('./users/learners/Learner'),
    props:true
  },
  {
    path:'/learnersubjects',
    name:'learnersubjects',
    component:require('./users/learners/LearnerSubjects'),
    props:true
  },

  {
    path:'/assessments',
    name:'assessments',
    component:require('./assessments/Assessments'),
    props:true
  },

  {
    path:'/learnerassessments',
    name:'learnerassessments',
    component:require('./assessments/LearnerAssessments'),
    props:true
  },

  {
    path:'/learnerassessmentmarks',
    name:'learnerassessmentmarks',
    component:require('./assessments/LearnerAssessmentMarks'),
    props:true
  },

  {
    path:'/learnermarks',
    name:'learnermarks',
    component:require('./assessments/LearnerMarks'),
    props:true
  },

  {
    path:'/uploadmarksheet',
    name:'uploadmarksheet',
    component:require('./assessments/UploadMarksheet'),
    props:true
  },

  {
    path:'/learnerattendance',
    name:'learnerattendance',
    component:require('./attendance/LearnerAttendance'),
    props:true
  }

];


export default new VueRouter({
  routes,
  linkActiveClass:'active'
});
