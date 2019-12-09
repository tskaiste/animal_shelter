import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
// import Register from './pages/Register'
import Login from './pages/Login'
import Shelters from './pages/admin/Shelters'
import Employees from './pages/admin/Employees'
import Animals from './pages/user/Animals'
import Bills from './pages/user/Bills'
import Cages from './pages/user/Cages'
import Clients from './pages/user/Clients'
import Donations from './pages/user/Donations'
import Resources from './pages/user/Resources'

// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  // {
  //   path: '/register',
  //   name: 'register',
  //   component: Register,
  //   meta: {
  //     auth: false
  //   }
  // },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/animals',
    name: 'animals',
    component: Animals,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/bills',
    name: 'bills',
    component: Bills,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/cages',
    name: 'cages',
    component: Cages,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/clients',
    name: 'clients',
    component: Clients,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/donations',
    name: 'donations',
    component: Donations,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/resources',
    name: 'resources',
    component: Resources,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  // ADMIN ROUTES
  {
    path: '/shelters',
    name: 'shelters',
    component: Shelters,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/employees',
    name: 'employees',
    component: Employees,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router