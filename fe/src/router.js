import { createRouter, createWebHistory } from 'vue-router'
import Home from './pages/Home.vue'
import SignIn from './pages/SignIn.vue'
import PostAJob from './pages/PostAJob.vue'
import JobPost from './pages/JobPost.vue'
import PublishJobPost from "./pages/PublishJobPost.vue";

const routerHistory = createWebHistory()

const router = createRouter({
  scrollBehavior(to) {
    if (to.hash) {
      window.scroll({ top: 0 })
    } else {
      document.querySelector('html').style.scrollBehavior = 'auto'
      window.scroll({ top: 0 })
      document.querySelector('html').style.scrollBehavior = ''
    }
  },  
  history: routerHistory,
  routes: [
    {
      path: '/',
      component: Home
    },
    {
      path: '/signin',
      name: 'SignIn',
      component: SignIn
    },
    {
      path: '/post-a-job',
      component: PostAJob
    },    
    {
      path: '/job-post/:isInternal/:id/',
      name: 'JobPost',
      component: JobPost
    },
    {
      path: '/publish-job-post/:isPublished/:id/',
      name: 'PublishJobPost',
      component: PublishJobPost,
    }
  ]
})

export default router
