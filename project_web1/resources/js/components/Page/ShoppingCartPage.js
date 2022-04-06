import React, { useContext, useEffect, useRef, useState } from 'react'

import '../assets/css/Container.css';
import '../assets/css/ShoppingCartPage.css';
import '../assets/css/LayoutWrapper.css';

import { Layout, Row, Col } from 'antd';
import LayoutWrapper from '../Components/LayoutWrapper';
import CartList from '../Components/ShoppingCart/CartList'
import ShoppingCartPay from '../Components/ShoppingCartPay';
import { AuthContext } from '../Contexts/AuthContext';

// Redux:
import { useDispatch, useSelector } from 'react-redux';
import { getCartItems, updateCart, deleteCartItem, softDeleteCartItem, restoreCartItem, deleteAllCartItem, getCartsIsNotDeletedItems } from '../redux/reducers/cart';

import {setIsUpdate} from '../redux/reducers/cart'

function formatCash(str) {
    return str.split('').reverse().reduce((prev, next, index) => {
        return ((index % 3) ? next : (next + '.')) + prev
    })
}

function ShoppingCartPage() {

    // useState
    const [productsWasClicked, setProductsWasClicked] = useState([]);
    let isQuantityUpdate = null;

    // Context
    const authCtx = useContext(AuthContext)

    // Redux
    const dispatch = useDispatch();
    const { cartItems, isUpdated } = useSelector(state => state.cart);

    useEffect(() => {
        const payload = {
            token: authCtx.token,
        }
        const action = getCartItems(payload);
        dispatch(action);
    }, [isUpdated]);

    const handleSetAllData  = () => {
        const payload = {
            token: authCtx.token,
        }
        const action = getCartItems(payload);
        dispatch(action);
        dispatch(setIsUpdate())

    }

    const handleGetDataIsNotDeleted = () => {
        dispatch(getCartsIsNotDeletedItems());

    }

    // Handle Event
    const handleProductWasClicked = (productsWasClicked) => {
        setProductsWasClicked(productsWasClicked);
    }

    const handleSetQuantity = (quantity, record) => {
        if(isQuantityUpdate) {
            clearTimeout(isQuantityUpdate);
        }
        let newProductsWasList = [];
        productsWasClicked.map(productWasClicked => {
            if (productWasClicked.id_product = record.id_product) {
                productWasClicked.quantity = quantity;
            }
            newProductsWasList.push(productWasClicked);
        })
        isQuantityUpdate = setTimeout(() => {
            const params = {
                id_product: record.id_product,
                quantity,
            }
            const payload = {
                token: authCtx.token,
                params: params
            }
            const action = updateCart(payload);
            dispatch(action);
        }, 1000);

    }

    function handleDeleteProduct(record) {
        const params = {
            id_product: record.id_product,
        }
        const payload = {
            token: authCtx.token,
            params: params
        }
        const action = deleteCartItem(payload);
        dispatch(action);
    }

    function handleSoftDeleteProduct(record) {
        const params = {
            id_product: record.id_product,
        }
        const payload = {
            token: authCtx.token,
            params: params
        }
        dispatch(softDeleteCartItem(payload));
        dispatch(setIsUpdate())
    }
    
    function handleRestoreProducts(record) {
        const params = {
            id_product: record.id_product,
        }
        const payload = {
            token: authCtx.token,
            params: params
        }
        dispatch(restoreCartItem(payload));
        dispatch(setIsUpdate())
    }

    function handleDeleteAllProducts() {
        const payload = {
            token: authCtx.token,
        }
        dispatch(deleteAllCartItem(payload));
        dispatch(setIsUpdate())
    }


    const mainContent = () => {
        return (
            <div className="container">
                <h1 className="shopping-cart-page-title">Giỏ hàng</h1>
                <Row gutter={16}>
                    <Col xs={24} lg={16}>
                        <CartList
                            formatCash={formatCash}
                            handleSetQuantity={handleSetQuantity}
                            productList={cartItems == 'Your cart is empty!' ? [] : cartItems}
                            handleProductWasClicked={handleProductWasClicked}
                            handleDeleteProduct={handleDeleteProduct}
                            handleSoftDeleteProduct={handleSoftDeleteProduct}
                            handleRestoreProducts={handleRestoreProducts}
                            handleDeleteAllProducts={handleDeleteAllProducts}
                            handleSetAllData={handleSetAllData}
                            handleGetDataIsNotDeleted={handleGetDataIsNotDeleted}
                             />
                    </Col>
                    <Col xs={24} lg={8}>
                        <ShoppingCartPay
                            formatCash={formatCash}
                            productsWasClicked={productsWasClicked} />
                    </Col>
                </Row>
            </div>
        );
    }

    return (
        <>
            <div className="cart-page">
                <LayoutWrapper mainContent={mainContent}></LayoutWrapper>
            </div>
        </>
    )
}

export default ShoppingCartPage
