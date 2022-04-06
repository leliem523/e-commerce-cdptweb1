import { Button } from 'antd';
import React, { useContext, useState } from 'react';

// Context:
import { AuthContext } from '../Contexts/AuthContext';

// Redux:
import { useDispatch, useSelector } from 'react-redux';
import ModalBoxPaymentMethod from './ModalBoxPayment/ModalBoxPaymentMethod';

// CSS:
import '../assets/css/ShoppingCartPay.css';
import useDisplayModal from '../hooks/useDisplayModal';


const ShoppingCartPay = ({ productsWasClicked, formatCash }) => {
    
    let total = 0;

    if (productsWasClicked && productsWasClicked.length > 0) {
        productsWasClicked.map(product => {
            total += product.price * product.quantity;
        });
    }
    // Context:
    const authCtx = useContext(AuthContext);

    // Redux:
    const {
        selected_province,
        selected_district,
        selected_ward,
        btnTitle
    } = useSelector(state => state.locations);

    const dispatch = useDispatch();

    // Logic modal box payment methods
    const [isModalVisible, showModal, handleOk, handleCancel] = useDisplayModal();

  

    return (
        <React.Fragment>
            <div className="place-of-delivery">
                <div className="heading">
                    <p className="title-place">Giao tới</p>
                    <p className="change-button">Thay đổi</p>
                </div>
                <div className="title">
                    <p className="user-name">{authCtx.isLoggedIn === true ? authCtx.data.name : 'Unknown'}</p>
                    <p className="user-number">(0123) 456 789</p>
                </div>
                <div className="address">
                    <p className='place-of-delivery__content'>35, Huỳnh Tú, Phường 05, Quận 11, TP. Hồ Chí Minh</p>
                </div>
            </div>

            <div className="shop-location">
                <div className="heading">
                    <p className="title-place">Địa điểm mua hàng</p>
                    <label htmlFor='checkbox-for-LocationList' className="change-button">Thay đổi</label>
                </div>
                <div className="location">
                    <p className='shop-location__content'>{selected_province !== -1 ? btnTitle : 'Bạn chưa chọn địa điểm mua hàng'}</p>
                </div>
            </div>

            <div className="prices-total">
                <div className="total-box">
                    <p className="total-title">Tổng cộng: </p>
                    <p className="total-field">{total == 0 ? 'Vui lòng chọn sản phẩm' : `${formatCash(total.toString())}₫`}</p>

                </div>
                <Button 
                    className="submit" 
                    type="primary" 
                    onClick={showModal}
                    danger
                    disabled={productsWasClicked.length==0}
                    >Mua hàng</Button>

                <ModalBoxPaymentMethod
                    isModalVisible={isModalVisible}
                    handleOk={handleOk}
                    handleCancel={handleCancel} />
            </div>


        </React.Fragment>
    );
}

export default ShoppingCartPay;
