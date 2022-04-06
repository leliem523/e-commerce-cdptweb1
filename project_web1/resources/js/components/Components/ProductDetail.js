import React, { useState, useContext } from 'react';
import '../assets/css/ProductDetail.css';

import { Row, Col, Image, InputNumber, Rate } from 'antd';
import nextId from "react-id-generator";
import { AuthContext } from '../Contexts/AuthContext';

// Redux:
import { useDispatch, useSelector } from 'react-redux';
import { addCartItem } from '../redux/reducers/cart';
import axios from 'axios';
import { stringify } from 'postcss';

function formatCash(str) {
    return str.split('').reverse().reduce((prev, next, index) => {
        return ((index % 3) ? next : (next + '.')) + prev
    })
}

const ProductDetail = ({ product, setIsUpdateProduct }) => {
    const dispatch = useDispatch();

    const [productQuantity, setProductQuantity] = useState(1);
    const authCtx = useContext(AuthContext);
    const isRatingClickName = authCtx.data.id + '_' +  product.id;
    if(localStorage.getItem(isRatingClickName)) {
        localStorage.setItem(isRatingClickName, false);
        
    }

    const handleChange = (value) => {
        setProductQuantity(value);
    }

    const handleClickToBuy = () => {
        const params = {
            id_product: product.id,
            name: product.name,
            quantity: productQuantity,
        }
        const payload = {
            token: authCtx.token,
            params: params
        }
        const action = addCartItem(payload);
        dispatch(action);


    }

    const handleClickRating = (value) => {
        try {
            const param = {
                value: value,
            };
            axios.post(`/api/rating/${product.id}`, param, {
                headers: {
                    Authorization: `Bearer ${authCtx.token}`
                }
            })
            localStorage.setItem(isRatingClickName, true);
            setIsUpdateProduct(true);
        }
        catch(err) {
            console.log(err)
        }
        
    }

    return (
        <React.Fragment>
            <div className="product-detail">
                <Row className="product-detail-row" gutter={16}>
                    <Col xs={24} lg={12}>
                        <div className="product-img-wrapper">
                            <Image
                                className="logo"
                                className="product-img"
                                src={product.image}
                                alt={`product-img`}
                            />
                        </div>
                    </Col>
                    <Col xs={24} lg={12} className="component-layout">
                        <div className="product__sellingInfo">
                            <div className="product-name">{product.name}</div>
                            <div className="rating">
                                <Rate 
                                    disabled={localStorage.getItem(isRatingClickName)}
                                    allowClear={false}
                                    onChange={handleClickRating} 
                                    value={Math.round(parseFloat(product.rating_value))} 
                                />
                                {
                                    localStorage.getItem(isRatingClickName) && <span>({product.rating_times} lượt đánh giá)</span>
                                }
                            </div>
                            <div className="product-price">{formatCash((product.price * productQuantity).toString())}₫</div>
                            <div className="quantity">
                                <label htmlFor="quantityField">Số lượng:</label>
                                <InputNumber id="quantityField" min={1} max={100000} defaultValue={productQuantity} onChange={handleChange} />
                            </div>
                            <button className="buy-btn" onClick={handleClickToBuy}>Chọn mua</button>
                        </div>
                    </Col>
                </Row>
            </div>
        </React.Fragment>
    );
}

export default ProductDetail;
