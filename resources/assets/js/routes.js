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
  }
];


export default new VueRouter({
  routes,
  linkActiveClass:'active'
});
