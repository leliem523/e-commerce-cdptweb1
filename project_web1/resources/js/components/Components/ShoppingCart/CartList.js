import React, { useState } from 'react'
import '../../assets/css/CartList.css'
import { Table, InputNumber, Button, Dropdown, Menu } from 'antd';
import { DeleteOutlined, RedoOutlined, DownOutlined, CheckOutlined  } from '@ant-design/icons';
import swal from 'sweetalert';
import { useDispatch } from 'react-redux';


function CartList
({
  productList,
   handleProductWasClicked,
    handleSetQuantity, 
    formatCash, 
    handleDeleteProduct, 
    handleSoftDeleteProduct,
    handleRestoreProducts,
    handleDeleteAllProducts,
  }) {

    const [ checkStrictly ] = React.useState(false);
    const [isDisplayProductDeleted, setIsDisplayProductDeleted] = useState(false);
    const [isDisplayProductDeletedContent, setIsDisplayProductDeletedContent] = useState('Hiển thị');
    const columns = [
      {
        title: 'Product name',
        dataIndex: 'name',
        key: 'name',
        width: '25%',
      },
      {
        title: 'price',
        dataIndex: 'priceDisplay',
        key: 'priceDisplay',
        width: '25%',
      },
      {
        title: 'quantity',
        dataIndex: 'quantity',
        key: 'quantity',
        render: (quantity, record) => <InputNumber 
                                          className="cart-list-quantity"
                                          defaultValue={quantity}
                                          min={1} max={10000}
                                          onChange={(event)=>handleSetQuantity(event, record)}
                                          disabled={record.deleted_at != null}
                                           />,
      },
      {
        title: 'Total',
        dataIndex: 'total',
        width: '25%',
        key: 'total',
      },
      {
        key: 'id_product',
      },
      {
        key: 'delete',
        width: '25%',
        render: (e, record) => 
        <div style={{ display: 'flex' }}>
         {
           record.deleted_at != null && 
            <Button 
                type="primary" 
                onClick={() => RestoreProduct(record)} 
                icon={<RedoOutlined />} ghost />
         }
          <Button 
                type="primary" 
                onClick={() => DeleteProduct(record)} 
                icon={<DeleteOutlined />} danger />
        </div>
      },
    ];

    const menuOptions = (
      <Menu onClick={e => handleMenuOptionClick(e)} disabled={productList.length == 0}>
        <Menu.Item key={0}>
          <p>Xóa tất cả sản phẩm</p>
        </Menu.Item>
        <Menu.Item key={1}>
          <p>{isDisplayProductDeletedContent} sản phẩm trong thùng rác</p>
        </Menu.Item>
      </Menu>
    );

    const handleMenuOptionClick = (e) => {
       if(e.key === '0') {
         deleteAllProduct();
       }
       else if(e.key == '1') {
         setIsDisplayProductDeleted(!isDisplayProductDeleted);
         setIsDisplayProductDeletedContent(!isDisplayProductDeleted ? 'Ẩn' : 'Hiển thị');
       }
    }

    const DeleteProduct = (record) => {
      if(!record.deleted_at) {
        swal({
          title: "Xóa sản phẩm",
          text: `Bạn có thực sự muốn xóa "${record.name}" không ?`,
          icon: "warning",
          buttons: ['Loại bỏ', 'Xác nhận'],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            handleSoftDeleteProduct(record)
            swal(`Bạn đã xóa "${record.name}" thành công !!`, {
              icon: "success",
            });
          }
        });
      }
      else {
        swal({
          title: "Xóa sản phẩm",
          text: `Sản phẩm sẽ bị xóa vĩnh viễn, bạn có muốn tiếp tục không ?`,
          icon: "warning",
          buttons: ['Loại bỏ', 'Xác nhận'],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            handleDeleteProduct(record)
            swal(`Bạn đã xóa "${record.name}" thành công !!`, {
              icon: "success",
            });
          }
        });
      }
     
    }
    
    const RestoreProduct = (record) => {
      swal({
        title: "Phục hồi sản phẩm",
        text: `Sản phẩm sẽ được phục hồi, bạn có muốn tiếp tục không ?`,
        icon: "warning",
        buttons: ['Loại bỏ', 'Xác nhận'],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          handleRestoreProducts(record)
          swal(`Bạn đã phục hồi "${record.name}" thành công !!`, {
            icon: "success",
          });
        }
      });
    }

    const deleteAllProduct = () => {
      swal({
        title: "Xóa tất cả sản phẩm",
        text: `Sản phẩm của bạn sẽ bị xóa toàn bộ, bạn có muốn tiếp tục không ?`,
        icon: "warning",
        buttons: ['Loại bỏ', 'Xác nhận'],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          handleDeleteAllProducts()
          swal(`Bạn đã xóa tất cả sản phẩm thành công !!`, {
            icon: "success",
          });
        }
      });
    }
    
    const datas = [];
    if(!isDisplayProductDeleted) {
      productList.map((product, index) => {
        if(product.pivot.deleted_at == null) {
          datas.push({
            key: index,
            id_product: product.pivot.id_product,
            name: product.name,
            price: product.price,
            priceDisplay: `${formatCash(product.price.toString())}₫`,
            quantity: product.pivot.quantity,
            total: `${formatCash((product.price * product.pivot.quantity).toString())}₫`,
            deleted_at: product.pivot.deleted_at,
            responsive: ['md'],
          })
        }
      });
    }
    else {
      productList.map((product, index) => {
        datas.push({
          key: index,
          id_product: product.pivot.id_product,
          name: product.name,
          price: product.price,
          priceDisplay: `${formatCash(product.price.toString())}₫`,
          quantity: product.pivot.quantity,
          total: `${formatCash((product.price * product.pivot.quantity).toString())}₫`,
          deleted_at: product.pivot.deleted_at,
          responsive: ['md'],
        })
      });
    }
    
    // rowSelection objects indicates the need for row selection
    const rowSelection = {
      onChange: (selectedRowKeys, selectedRows) => {
        handleProductWasClicked(selectedRows);
      },
      onSelect: (record, selected, selectedRows) => {
        handleProductWasClicked(selectedRows);
      },
      onSelectAll: (selected, selectedRows, changeRows) => {
        handleProductWasClicked(selectedRows);
      },
      getCheckboxProps: (record) => {
        return {
           disabled: record.deleted_at != null,
        };
      }
    };

    return (
       <div className="cart-list">
         <div className="cart-list-options">
         <Dropdown overlay={menuOptions}>
          <Button>
              Options <DownOutlined />
          </Button>
        </Dropdown>
         </div>
            <Table
              className="cart-list-table"
              columns={columns}
              rowSelection={{ ...rowSelection, checkStrictly }}
              dataSource={datas}
            />
       </div>
    )
}

export default CartList
