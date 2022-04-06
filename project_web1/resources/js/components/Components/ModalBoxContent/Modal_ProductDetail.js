import React from 'react';

import '../../assets/css/Modal_ProductDetail.css';

import { Row, Col } from 'antd';

import { ZoomInOutlined } from '@ant-design/icons';

import { Link } from 'react-router-dom';

const changeToSlug = (name) => {
      //Đổi chữ hoa thành chữ thường
      let slug = name.toLowerCase();

      //Đổi ký tự có dấu thành không dấu
      slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
      slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
      slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
      slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
      slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
      slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
      slug = slug.replace(/đ/gi, 'd');
      //Xóa các ký tự đặt biệt
      slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
      //Đổi khoảng trắng thành ký tự gạch ngang
      slug = slug.replace(/ /gi, "-");
      //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
      //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
      slug = slug.replace(/\-\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-/gi, '-');
      slug = slug.replace(/\-\-/gi, '-');
      //Xóa các ký tự gạch ngang ở đầu và cuối
      slug = '@' + slug + '@';
      slug = slug.replace(/\@\-|\-\@|\@/gi, '');
      //In slug ra textbox có id “slug”
      return slug;
}


const formatCash = (str) => {
    return str.split('').reverse().reduce((prev, next, index) => {
        return ((index % 3) ? next : (next + '.')) + prev
    })
}

function Modal_ProductDetail({ content, product }) {
    
    return (
        <>
            <div className="modal-productdetail">
                <Row>
                    <Col span={6}>
                        <div className="product-img-wrapper">
                            <img className="product-img" alt={`product-img`} src={product.image}></img>
                        </div>
                    </Col>
                    <Col span={18}>
                        <div className="product__quickInfo">
                            <input type="hidden" name="indexOfSelectedItem" value={content}></input>
                            <div className="product-name">
                                <Link to={`/product/${changeToSlug(product.name) + '-' + product.id}`}>
                                    {product.name}
                                </Link>
                            </div>
                            <div className="product-price">{formatCash(product.price.toString())}₫</div>
                            <div className="list-of-controls">
                                <div className="readmore-btn">
                                    <Link to={`/product/${changeToSlug(product.name) + '-' + product.id}`} style={{ color: 'white' }}>
                                        <span className="readmore-btn__title">Xem chi tiết </span>
                                    </Link>
                                    <ZoomInOutlined />
                                </div>
                            </div>
                        </div>
                    </Col>
                </Row>
                <Row>
                    <div className="product-description">{product.description.slice(0, 200)} ...</div>
                </Row>
            </div>
        </>
    );
}

export default Modal_ProductDetail;