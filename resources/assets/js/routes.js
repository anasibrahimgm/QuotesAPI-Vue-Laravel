import Quotes from './components/Quotes.vue'
import newQuote from './components/newQuotes.vue'
import signUp from './components/signUp.vue'
import signIn from './components/signIn.vue'

export default [
  {path: '', component: Quotes},
  {path: '/new-quote', component: newQuote},
  {path: '/signup', component: signUp},
  {path: '/signin', component: signIn},
]
