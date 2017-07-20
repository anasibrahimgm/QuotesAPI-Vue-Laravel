import Quotes from './components/Quotes.vue'
import newQuote from './components/newQuotes.vue'

export default [
  {path: '', component: Quotes},
  {path: '/new-quote', component: newQuote},
]
