/**
 * 登陆页js
 */

import React from 'react';
import {render} from 'react-dom';
import {Form, Input, Button, Alert} from 'antd';
import $ from 'jquery';
const FormItem = Form.Item;

// import '../css/com.css';

class AppLogin extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            visible: 'none',
            errMsg: ''
        };
    }

    handleSubmit = (e) => {
        e.preventDefault();
        this.props.form.validateFields((errors, values) => {
        if (!!errors) {
            console.log('表单有误');
            return;
        }
        this.checkLogin(values);
        });
    }

    checkLogin = (values) => {
        //console.log(values);
        const url = '/pass/login';
        $.post(url, values, (result) => {
            if (result.status == 0) {
                location.href = '/';
            } else {
                this.setState({visible: '', errMsg: result.msg});
            }
        });
    }

    _noop() {
        return false;
    }

    render() {
        const {getFieldProps} = this.props.form;
        const emailProps = getFieldProps('email', {
            validate: [{
                rules: [
                    {required: true, message: '请填写邮箱'}
                ],
                trigger: 'onBlur'
            }, {
                rules: [
                    {type: 'email', message: '请输入正确的邮箱地址'}
                ],
                trigger: ['onBlur', 'onChange']
            }]
        });
        const passwdProps = getFieldProps('password', {
            rules: [
                {required: true, whitespace: true, message: '请填写密码'}
            ]
        });
        const formItemLayout = {
            labelCol: {span: 7},
            wrapperCol: {span: 12}
        };
        return (
            <div>
                <Form horizontal form={this.props.form} className="login-form">
                <FormItem
                {...formItemLayout}
                label="账号"
                hasFeedback
                >
                <Input {...emailProps} type="email" placeholder="输入Pocket账户"/>
                </FormItem>

                <FormItem
                {...formItemLayout}
                label="密码"
                hasFeedback
                >
                <Input {...passwdProps} type="password" autoComplete="off" placeholder="输入Pocket密码"
                onContextMenu={this._noop} onPaste={this._noop} onCopy={this._noop}
                onCut={this._noop}/>
                </FormItem>

                <FormItem wrapperCol={{ span: 12, offset: 7 }}>
                    <Button type="primary" size="large" onClick={this.handleSubmit}>登录</Button>
                </FormItem>
                <FormItem wrapperCol={{ span: 12, offset: 7 }} style={{display:this.state.visible}}>
                    <Alert message={this.state.errMsg} type="error" showIcon="true" />
                </FormItem>
                </Form>
            </div>
        );
    }
}

AppLogin = Form.create({})(AppLogin);

render(<AppLogin />, document.getElementById('app-login'));
