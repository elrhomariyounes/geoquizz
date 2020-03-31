import Vue from 'vue'
import VueRouter from 'vue-router'
import Menu from '../components/Menu.vue'
import Register from '../components/Register'
import Newserie from '../components/AddSerie'
import NewPicture from '../components/AddPicture'
import OldPicture from '../components/Pictures'
Vue.use(VueRouter)
const routes = [
{
path: '/home',
name: 'Menu',
component: Menu
},
{
path: '/about',
name: 'About',
// route level code-splitting
// this generates a separate chunk (about.[hash].js) for this route
// which is lazy-loaded when the route is visited.
component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
},
{
path: '/',
name: 'Register',
component: Register
},
{
path: '/series',
name: 'NewSerie',
component: Newserie
},
{
path: '/pictures',
name: 'NewPicture',
component: NewPicture
},
{
path: '/oldpictures',
name: 'oldpictures',
component: OldPicture
}
]
const router = new VueRouter({
routes
})
export default router