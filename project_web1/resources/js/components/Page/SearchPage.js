import React, { useContext, useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { useLocation } from 'react-router-dom';
import { Spin } from 'antd';
import '../assets/css/Container.css';
import '../assets/css/SearchPage.css';
import '../assets/css/LoadingSpinner.css';
import FooterSection from '../Components/FooterSection';
import HeaderLayout from '../Components/Layouts/HeaderLayout';
import ListOfProductsSearch from '../Components/ListOfProductsSearch';
import { AuthContext } from '../Contexts/AuthContext';
import { searchProducts } from '../redux/reducers/products';
import { useHistory } from 'react-router-dom/cjs/react-router-dom.min';
import LayoutWrapper from '../Components/LayoutWrapper';

const SearchPage = (props) => {
    const authCtx = useContext(AuthContext);

    const [isSpinner, setIsSpinner] = useState(true);
    const history = useHistory();

    const dispatch = useDispatch();

    const { products } = useSelector(state => state.products);

    const search = useLocation().search;
    const key = new URLSearchParams(search).get("key");


    useEffect(() => {
        if (key == null) history.push('/404');
        setIsSpinner(true);
        setTimeout(() => {
            const payload = {
                key,
                token: authCtx.token,
            }
            dispatch(searchProducts(payload))
            setIsSpinner(false);
        }, 1500);
       
    }, [key])

   

    const pageContent = () => {
        return (
            <>
                {
                    !isSpinner ?
                        <ListOfProductsSearch
                            keySearch={key}
                            products={products} /> :
                        <Spin className='loading-spinner--default' spinning={isSpinner} delay={0}></Spin>
                }
            </>
        );
    }

    // Page content:
    const mainContent = () => {
        return (
            <>
                <div className="container">
                    {pageContent()}
                </div>
            </>
        );
    }

    return (
        <>
            <div className="search-page">
                <LayoutWrapper mainContent={mainContent}></LayoutWrapper>
            </div>
        </>
    );
}

export default SearchPage;
