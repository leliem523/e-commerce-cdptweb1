import React from 'react'
import ReactDOM from 'react-dom'
import App from "./App"
import AuthContextProvider from './Contexts/AuthContext'
import { BrowserRouter } from 'react-router-dom'
import { Provider } from 'react-redux'
import store from './redux/store'
import ScrollToTop from './Components/ScrollToTop'

if (typeof (Storage) !== 'undefined') {
    ReactDOM.render(
        <Provider store={store}>
            <AuthContextProvider>
                <BrowserRouter>
                    <ScrollToTop />
                    <App />
                </BrowserRouter>
            </AuthContextProvider>
        </Provider>
        , document.getElementById('root'))
}