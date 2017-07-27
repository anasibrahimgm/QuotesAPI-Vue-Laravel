import Quotes from './components/Quotes.vue'
import signUp from './components/signUp.vue'
import signIn from './components/signIn.vue'

export default [
  {path: '', component: Quotes},
  {path: '/signup', component: signUp},
  {path: '/signin', component: signIn},
]
