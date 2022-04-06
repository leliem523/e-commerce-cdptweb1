import { Spin } from 'antd';
import { ErrorMessage, Field, Form, Formik } from 'formik';
import React, { useContext, useState } from 'react';
import { Link, useHistory } from 'react-router-dom';
import { AuthContext } from '../Contexts/AuthContext';
import * as Yup from 'yup';
import styles from '../Styles/UpdateUserInfo.module.css';
import LayoutWrapper from '../Components/LayoutWrapper';
import { deprecationHandler } from 'moment';

const UpdateUserInfoPage = () => {
    const authCtx = useContext(AuthContext);
    const [feedBack, setFeedBack] = useState(null);

    const mainContent = () => {
        return (
            <Formik
            initialValues={{ username: '', password: '', password_confirmation: '', }}
            validationSchema={Yup.object({
                username: Yup.string().required('Required'),
                password: Yup.string().required('Required'),
                password_confirmation: Yup.string().required('Required'),
            })}
            onSubmit={(values, { setSubmitting }) => {
                const params = {
                    name: values.username,
                    password: values.password,
                    password_confirmation: values.password_confirmation,
                    version: authCtx.data.version,
                };
                console.log(params)
                setTimeout(() => {
                    axios.post('/api/update-user', params, {
                        headers: {
                            Authorization: `Bearer ${authCtx.token}`
                        }
                    })
                        .then(response => {
                            swal({
                                title: "Chỉnh sửa thông tin thành công !!",
                                text: "Thông tin đã được chỉnh sửa !!",
                                icon: "success",
                                button: "Ok!",
                            });
                            setFeedBack(null)
                            console.log(response)
                            // history.replace("/");
                        })
                        .catch(error => {
                           if(error.response.status == 422) {
                            swal({
                                title: error.response.data.message,
                                text: error.response.data.errors.password[0],
                                icon: "warning",
                                button: "Ok!",
                            });
                           }
                        })
                    setSubmitting(false);
                }, 400);
            }}
        >
            {formik => (
                <div className={styles.box}>
                    <div className={styles.container}>
                    <div className={styles.wrapper}>
                        <div className={styles.title}>
                            Thay đổi thông tin
                        </div>
                        <Form>
                            <div className={styles.field}>
                                <Field name="username" placeholder="Tên người dùng ..." type="text" className={styles.field_input} />
                                <ErrorMessage name="username">{msg => <div className={styles.error}>{msg}</div>}</ErrorMessage>
                            </div>
    
                            <div className={styles.field}>
                                <Field name="password" placeholder="Mật khẩu mới ..." type="password" className={styles.field_input} />
                                <ErrorMessage name="password">{msg => <div className={styles.error}>{msg}</div>}</ErrorMessage>
                            </div>
    
                            <div className={styles.field}>
                                <Field name="password_confirmation" placeholder="Nhập lại mật khẩu mới ..." type="password" className={styles.field_input} />
                                <ErrorMessage name="password_confirmation">{msg => <div className={styles.error}>{msg}</div>}</ErrorMessage>
                            </div>
                            {
                                feedBack ?
                                    <div className={styles.feedback}>
                                        {feedBack}
                                    </div>
                                    : null
                            }
                            <div className={styles.field}>
                                {
                                    formik.isSubmitting ? <Spin style={{ padding: '15px 0 0' }} /> : <button type="submit" className={styles.input}>Submit</button>
                                }
                            </div>
                        </Form>
                    </div>
                </div>
                </div>
            )}
        </Formik >
        );
    }

    return (
        <LayoutWrapper mainContent={mainContent}></LayoutWrapper>
    );
}

export default UpdateUserInfoPage;
