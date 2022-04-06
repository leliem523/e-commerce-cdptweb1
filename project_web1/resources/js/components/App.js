import React, { useContext } from 'react'

import './assets/css/Font.css'

import { Switch, Route, Redirect } from "react-router-dom"
import LogInPage from './Page/LogInPage'
import { AuthContext } from './Contexts/AuthContext';

import LogOut from './Components/LogOut/LogOut';
import Products_Show from './Components/Products_Show/Products_Show';
import RegisterPage from './Page/RegisterPage';
import HomePage from './Page/HomePage';
import ProductDetailPage from './Page/ProductDetailPage';
import ShoppingCartPage from './Page/ShoppingCartPage';
import SearchPage from './Page/SearchPage';
import NotFoundPage from './Page/NotFoundPage';
import ProductListPage from './Page/ProductListPage';
import UpdateUserInfoPage from './Page/UpdateUserInfoPage';

function Home() {
    return (
        <React.Fragment>
            <LogOut />
            <Products_Show />
        </React.Fragment>
    );
}

function App() {
    const authCtx = useContext(AuthContext);
    return (
        <React.Fragment>
            {
                !authCtx.isLoggedIn &&
                <Switch>
                    <Route exact path='/'><Redirect to="/login" /></Route>
                    <Route exact path="/home"><Redirect to="/login" /></Route>
                    <Route path="/login" component={LogInPage} />
                    <Route path="/register" component={RegisterPage} />
                    <Route exact path="/404" component={NotFoundPage}/>
                    <Route ><Redirect to="/404"/></Route>
                </Switch>
            }
            {
                authCtx.isLoggedIn &&
                <Switch>
                    {/* <Route exact path="/" component={Home} /> */}
                    <Route exact path='/' component={HomePage}></Route>
                    <Route exact path="/home" component={HomePage}></Route>
                    <Route exact path="/shopping-cart" component={ShoppingCartPage} />
                    <Route exact path="/search" component={SearchPage}/>
                    <Route exact path="/product/:slug" component={ProductDetailPage} />
                    <Route exact path="/category/:slug" component={ProductListPage} />
                    <Route exact path="/update-information" component={UpdateUserInfoPage} />
                    <Route exact path="/404" component={NotFoundPage}/>
                    <Route ><Redirect to="/404"/></Route>
                </Switch>
            }

        </React.Fragment>
    )
}

export default App