import { Modal, Radio } from 'antd';
import React from 'react';
import useRadioChange from '../../hooks/useRadioChange';

const ModalBoxPaymentMethod = (props) => {
    // Custom hooks
    const [value, onChange] = useRadioChange();
    // UI
    return (
        <Modal title="Chọn hình thức thanh toán" 
            visible={props.isModalVisible} 
            onOk={props.handleOk} 
            onCancel={props.handleCancel}
            >
                <div className="payment-options">
                <Radio.Group onChange={onChange} value={value}>
                    
                    <div className="option-group">
                        <Radio value={1}>
                            <img src="https://frontend.tikicdn.com/_desktop-next
                            /static/img/icons/checkout/icon-payment-method-momo.svg" alt="" />
                            Thanh toán bằng ví MoMo
                        </Radio>
                        
                    </div>
                    <div className="option-group">
                        <Radio value={2}>
                            <img src="https://frontend.tikicdn.com/_desktop-next/static
                            /img/icons/checkout/icon-payment-method-zalo-pay.svg" alt="" />
                            Thanh toán bằng ví ZaloPay
                        </Radio>
                       
                    </div>
                    <div className="option-group">
                        <Radio value={3}>
                            <img src="https://frontend.tikicdn.com/
                            _desktop-next/static/img/icons/checkout/icon-payment-method-atm.svg" alt="" />
                            Thẻ ATM nội địa/Internet Banking (Hỗ trợ Internet Banking)
                        </Radio>
                        
                    </div>
                    <div className="option-group">
                        <Radio value={4}>
                        <img src="https://frontend.tikicdn.com/_desktop-next/
                        static/img/icons/checkout/icon-payment-method-credit.svg" alt="" />
                            Thanh toán bằng thẻ quốc tế Visa, Master, JCB
                        </Radio>
                    </div>
                    <div className="option-group">
                        <Radio value={4}>
                            <img src="https://frontend.tikicdn.com/_desktop-next/
                            static/img/icons/checkout/icon-payment-method-cod.svg" alt="" />
                            Thanh toán tiền mặt khi nhận hàng
                        </Radio>
                    </div>    
                </Radio.Group>
                </div>
                
        </Modal>
    );
}

export default ModalBoxPaymentMethod;
