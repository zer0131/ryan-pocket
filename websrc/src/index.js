import React from 'react';
import {render} from 'react-dom';
import {Table} from 'antd';
import $ from 'jquery';

class IndexPage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            username:'未登录',
            dataSource:[],
            loading: true
        };
    }

    componentDidMount() {
        this._getUser();
        this._getArticleList();
    }

    _getArticleList = () => {
        let that = this;
        $.get('/api/to_be_read', {}, function(ret){
            if (ret.status == 0) {
                that.setState({dataSource: ret.data, loading:false});
            }
        });
    }

    _getUser = () => {
        let that = this;
        $.get('/api/userinfo',{}, function(ret){
            if (ret.status == 0) {
                that.setState({username: ret.data.account});
            }
        });
    }

    _read(itemId, originUrl) {
        let url = '/api/reading?item_id='+itemId+'&origin_url='+originUrl;
        window.open(url);
    }

    render() {
        const columns = [{
            title: '文章标题',
            dataIndex: 'given_title',
            key: 'given_title'
        }, {
            title: '添加时间',
            dataIndex: 'create_time',
            key: 'create_time'
        }, {
            title: '操作',
            key: 'opration',
            render: (test, record) => (
                <span>
                    <a href="javascript:;" onClick={this._read.bind(this, record.item_id, record.origin_url)}>阅读</a>
                </span>
            )
        }];
        return (
            <div>
                <div>
                    <h1>未读文章列表</h1>
                    {this.state.username}
                    &nbsp;&nbsp;
                    <a href="/">刷新</a>
                    &nbsp;&nbsp;
                    <a href="/passport/logout">退出</a>
                </div>
                <hr />
                <div>
                    <Table dataSource={this.state.dataSource} columns={columns} pagination={true} loading={this.state.loading} />
                </div>
            </div>
        )
    }
}

render(<IndexPage />, document.getElementById('container'));