import React, { Component } from "react";
import Menu from "./Menu";
import { Link } from "react-router-dom";
import "./style.scss";

// Require Editor JS files.
import "froala-editor/js/froala_editor.pkgd.min.js";
import "froala-editor/js/plugins.pkgd.min.js";

// Require Editor CSS files.
import "froala-editor/css/froala_style.min.css";
import "froala-editor/css/froala_editor.pkgd.min.css";

// Require Font Awesome.
import "font-awesome/css/font-awesome.css";
import FroalaEditor from "react-froala-wysiwyg";

import Modal from "react-modal";

const ColbyCMS = window.colbyCMS;
import _findIndex from "lodash/findIndex";

export default class Pages extends Component {
    constructor(props) {
        super(props);
        this.state = {
            pages: [],
            modalIsOpen: false,
            page: {
                title: "",
                body: "",
                slug: "",
                groups: []
            }
        };

        this.getPages = this.getPages.bind(this);
        this.deletePage = this.deletePage.bind(this);
        this.openModal = this.openModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
        this.handleModelChange = this.handleModelChange.bind(this);
        this.handleTitleChange = this.handleTitleChange.bind(this);
        this.handleSlugChange = this.handleSlugChange.bind(this);
        this.createPage = this.createPage.bind(this);
    }

    componentDidMount() {
        this.getPages();
    }

    openModal() {
        this.setState({
            modalIsOpen: true
        });
    }

    closeModal() {
        this.setState({
            modalIsOpen: false
        });
    }

    createPage(published = false) {
        let addendedPost = Object.assign(this.state.page, {
            user_id: ColbyCMS.currentUser.id,
            published
        });

        axios.post("/api/pages", addendedPost).then(response => {
            this.setState({
                modalIsOpen: false,
                page: {
                    title: "",
                    body: "",
                    slug: ""
                }
            });
            this.getPages();
        });
    }

    handleModelChange(model) {
        this.setState({
            page: {
                ...this.state.page,
                body: model
            }
        });
    }

    getPages() {
        axios.get("/api/pages").then(response => {
            this.setState({
                pages: response.data.data
            });
        });
    }

    deletePage(id) {
        axios.delete(`/api/pages/${id}`).then(response => {
            this.setState({
                pages: response.data.data,
                prev: response.data.links.prev,
                next: response.data.links.next
            });
        });
    }

    handleTitleChange(event) {
        this.setState({
            ...this.state,
            page: {
                ...this.state.page,
                title: event.target.value
            }
        });
    }

    handleSlugChange(event) {
        this.setState({
            ...this.state,
            page: {
                ...this.state.page,
                slug: event.target.value
            }
        });
    }

    render() {
        console.log(this.state);
        const customStyles = {
            content: {
                top: "50%",
                left: "50%",
                right: "auto",
                bottom: "auto",
                marginRight: "-50%",
                transform: "translate(-50%, -50%)"
            }
        };
        return (
            <div className="container-fluid">
                <div className="row">
                    <Menu />
                    <main
                        role="main"
                        className="col-md-9 ml-sm-auto col-lg-10 px-4"
                        style={{ paddingTop: "75px" }}
                    >
                        <h1>Pages</h1>
                        {_findIndex(
                            ColbyCMS.currentUser.permissions,
                            o => o.name === "admin.view.pages"
                        ) >= 0 && (
                            <div
                                style={{
                                    textAlign: "right",
                                    marginBottom: "20px"
                                }}
                            >
                                <button
                                    className="btn btn-primary"
                                    onClick={this.openModal}
                                >
                                    Add Page
                                </button>
                            </div>
                        )}
                        {this.state.pages.length === 0 && (
                            <div>No pages found</div>
                        )}
                        {this.state.pages.length > 0 && (
                            <table className="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th
                                            scope="col"
                                            style={{ width: "30%" }}
                                        >
                                            Title
                                        </th>
                                        <th
                                            scope="col"
                                            style={{ width: "10%" }}
                                        >
                                            Author
                                        </th>
                                        <th
                                            scope="col"
                                            style={{ width: "10%" }}
                                        >
                                            Published
                                        </th>
                                        <th
                                            scope="col"
                                            style={{ width: "10%" }}
                                        >
                                            Slug
                                        </th>
                                        <th
                                            scope="col"
                                            style={{ width: "10%" }}
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {this.state.pages.map((page, i) => {
                                        return (
                                            <tr key={i}>
                                                <td>
                                                    <Link
                                                        to={`/admin/pages/${page.id}`}
                                                    >
                                                        {page.title}
                                                    </Link>
                                                </td>
                                                <td>{page.user.name}</td>
                                                <td>
                                                    {page.published && (
                                                        <span>true</span>
                                                    )}
                                                    {!page.published && (
                                                        <span>false</span>
                                                    )}
                                                </td>
                                                <td>{`/${page.slug}`}</td>
                                                <td>
                                                    <button
                                                        className="btn btn-sm btn-primary"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Preview"
                                                        style={{
                                                            marginRight: "5px"
                                                        }}
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            strokeWidth="2"
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            className="feather feather-eye"
                                                        >
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle
                                                                cx="12"
                                                                cy="12"
                                                                r="3"
                                                            ></circle>
                                                        </svg>
                                                    </button>
                                                    <button
                                                        className="btn btn-sm btn-secondary"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Archive"
                                                        style={{
                                                            marginRight: "5px"
                                                        }}
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            strokeWidth="2"
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            className="feather feather-archive"
                                                        >
                                                            <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                                            <rect
                                                                x="1"
                                                                y="3"
                                                                width="22"
                                                                height="5"
                                                            ></rect>
                                                            <line
                                                                x1="10"
                                                                y1="12"
                                                                x2="14"
                                                                y2="12"
                                                            ></line>
                                                        </svg>
                                                    </button>
                                                    <button
                                                        className="btn btn-sm btn-danger"
                                                        onClick={this.deletePage.bind(
                                                            null,
                                                            page.id
                                                        )}
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Delete"
                                                        style={{
                                                            marginRight: "5px"
                                                        }}
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            strokeWidth="2"
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            className="feather feather-trash"
                                                        >
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        </svg>
                                                    </button>
                                                    <button
                                                        className="btn btn-sm btn-info"
                                                        onClick={() => {}}
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Duplicate"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-copy"
                                                        >
                                                            <rect
                                                                x="9"
                                                                y="9"
                                                                width="13"
                                                                height="13"
                                                                rx="2"
                                                                ry="2"
                                                            ></rect>
                                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        );
                                    })}
                                </tbody>
                            </table>
                        )}
                        <Modal
                            isOpen={this.state.modalIsOpen}
                            onRequestClose={this.closeModal}
                            style={customStyles}
                            contentLabel="Example Modal"
                            className="post-modal"
                            overlayClassName="post-modal-overlay"
                        >
                            <div>
                                <h2>New Page</h2>
                                <form>
                                    <div className="form-group">
                                        <label htmlFor="title">Title</label>
                                        <input
                                            id="title"
                                            className="form-control"
                                            value={this.state.page.title}
                                            onChange={this.handleTitleChange}
                                        />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="slug">Slug</label>
                                        <input
                                            id="slug"
                                            className="form-control"
                                            value={this.state.page.slug}
                                            onChange={this.handleSlugChange}
                                        />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="body">Body</label>
                                        <FroalaEditor
                                            tag="textarea"
                                            model={this.state.page.body}
                                            onModelChange={
                                                this.handleModelChange
                                            }
                                        />
                                    </div>
                                </form>
                            </div>
                            <div style={{ textAlign: "right" }}>
                                <button
                                    className="btn btn-link"
                                    onClick={this.closeModal}
                                >
                                    Cancel
                                </button>
                                <button
                                    className="btn btn-primary"
                                    style={{ marginRight: "7px" }}
                                    onClick={this.createPage}
                                >
                                    Save &amp; Close
                                </button>
                                <button
                                    className="btn btn-primary"
                                    onClick={this.createPage.bind(null, true)}
                                >
                                    Publish
                                </button>
                            </div>
                        </Modal>
                    </main>
                </div>
            </div>
        );
    }
}
