import React, { Component } from "react";
import Menu from "./Menu";
// import Axios from 'axios';
import { Link } from "react-router-dom";
import Toggle from "react-toggle";
import "react-toggle/style.css";

// Require Editor JS files.
import "froala-editor/js/froala_editor.pkgd.min.js";
import "froala-editor/js/plugins.pkgd.min.js";

// Require Editor CSS files.
import "froala-editor/css/froala_style.min.css";
import "froala-editor/css/froala_editor.pkgd.min.css";

// Require Font Awesome.
import "font-awesome/css/font-awesome.css";
import FroalaEditor from "react-froala-wysiwyg";

import "./style.scss";

import Modal from "react-modal";
import ReactDiffViewer from "react-diff-viewer";

import MediaLibrary from "./MediaLibrary";

export default class Pages extends Component {
    constructor(props) {
        super(props);
        this.state = {
            page: {},
            loading: true,
            modalIsOpen: false,
            revisionOpen: 0,
            slugRevealed: false,
            mediaModalIsOpen: false
        };

        this.getPage = this.getPage.bind(this);
        this.openModal = this.openModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
        this.updatePage = this.updatePage.bind(this);
        this.handleModelChange = this.handleModelChange.bind(this);
        this.handlePublishedChange = this.handlePublishedChange.bind(this);
        this.setOpenRevision = this.setOpenRevision.bind(this);
        this.revealSlug = this.revealSlug.bind(this);
        this.disableSlug = this.disableSlug.bind(this);
        this.onSlugChange = this.onSlugChange.bind(this);
        this.openMediaModal = this.openMediaModal.bind(this);
        this.closeMediaModal = this.closeMediaModal.bind(this);
        this.selectFeaturedImage = this.selectFeaturedImage.bind(this);
    }

    componentDidMount() {
        this.getPage();
    }

    getPage() {
        const pageId = this.props.match.params.id;
        axios.get(`/api/pages/${pageId}`).then(response => {
            this.setState({
                page: response.data.data,
                loading: false
            });
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

    handlePublishedChange() {
        this.setState({
            page: {
                ...this.state.page,
                published: !this.state.page.published
            }
        });
    }

    updatePage() {
        axios
            .put(`/api/pages/${this.props.match.params.id}`, this.state.page)
            .then(response => {
                this.setState({
                    page: response.data.data
                });
            });
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

    openMediaModal() {
        this.setState({
            mediaModalIsOpen: true
        });
    }

    closeMediaModal() {
        this.setState({
            mediaModalIsOpen: false
        });
    }

    setOpenRevision(id) {
        this.setState({
            revisionOpen: id
        });
    }

    revealSlug() {
        this.setState({
            slugRevealed: true
        });
    }

    disableSlug() {
        this.setState({
            slugRevealed: false
        });
    }

    onSlugChange(event) {
        this.setState({
            page: {
                ...this.state.page,
                slug: event.target.value
            }
        });
    }

    selectFeaturedImage(media) {
        console.log(media);

        axios
            .post(`/api/page/attachMedia/${this.state.page.id}`, {
                file: media.id
            })
            .then(response => {
                this.setState({
                    mediaModalIsOpen: false
                });
                this.getPage();
            });
    }

    render() {
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

        console.log(this.state);
        const pageId = this.props.match.params.id;
        return (
            <div className="container-fluid">
                <div className="row">
                    <Menu />
                    <main
                        role="main"
                        className="col-md-9 ml-sm-auto col-lg-10 px-4"
                        style={{ paddingTop: "75px" }}
                    >
                        <div className="row">
                            <div className="col-sm-9">
                                <form>
                                    <div className="form-group">
                                        <label htmlFor="title">Title</label>
                                        <input
                                            id="title"
                                            className="form-control"
                                            value={this.state.page.title}
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
                            <div className="col-sm-3">
                                <div
                                    style={{
                                        boxShadow: "0 1px 1px rgba(0,0,0,.04)",
                                        border: "1px solid #e5e5e5",
                                        background: "#fff",
                                        marginBottom: "20px"
                                    }}
                                >
                                    <div
                                        style={{
                                            borderBottom: "1px solid #eee",
                                            padding: "10px",
                                            fontSize: " 1.5em"
                                        }}
                                    >
                                        Page Info
                                    </div>
                                    <div style={{ padding: "10px" }}>
                                        <div>
                                            Published:{" "}
                                            <Toggle
                                                className="published-toggle"
                                                defaultChecked={
                                                    this.state.page.published
                                                }
                                                onChange={
                                                    this.handlePublishedChange
                                                }
                                                icons={false}
                                            />
                                        </div>
                                        <div>
                                            Revisions:{" "}
                                            {this.state.loading && (
                                                <span>loading...</span>
                                            )}
                                            {!this.state.loading && (
                                                <a
                                                    onClick={this.openModal}
                                                    style={{
                                                        cursor: "pointer",
                                                        color: "#007bff",
                                                        textDecoration:
                                                            "underline"
                                                    }}
                                                >
                                                    {
                                                        this.state.page
                                                            .revisions.length
                                                    }
                                                </a>
                                            )}
                                        </div>
                                        <div>
                                            Slug:{" "}
                                            {!this.state.slugRevealed && (
                                                <a
                                                    onClick={this.revealSlug}
                                                    style={{
                                                        cursor: "pointer",
                                                        color: "#007bff",
                                                        textDecoration:
                                                            "underline"
                                                    }}
                                                >
                                                    {this.state.page.slug}
                                                </a>
                                            )}
                                            {this.state.slugRevealed && (
                                                <span>
                                                    page/
                                                    <input
                                                        id="title"
                                                        onChange={
                                                            this.onSlugChange
                                                        }
                                                        value={this.state.page.slug.substring(
                                                            5,
                                                            this.state.page.slug
                                                                .length
                                                        )}
                                                    />
                                                    <button
                                                        className="btn btn-sm"
                                                        style={{ color: "red" }}
                                                        onClick={
                                                            this.disableSlug
                                                        }
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
                                                            className="feather feather-x"
                                                        >
                                                            <line
                                                                x1="18"
                                                                y1="6"
                                                                x2="6"
                                                                y2="18"
                                                            ></line>
                                                            <line
                                                                x1="6"
                                                                y1="6"
                                                                x2="18"
                                                                y2="18"
                                                            ></line>
                                                        </svg>
                                                    </button>
                                                </span>
                                            )}
                                        </div>
                                    </div>
                                    <div
                                        style={{
                                            background: "#f5f5f5",
                                            borderTop: "1px solid #ddd",
                                            padding: "10px"
                                        }}
                                    >
                                        <Link
                                            className="btn btn-link"
                                            style={{ marginRight: "5px" }}
                                            to={`/preview/page/${pageId}`}
                                            target="_blank"
                                        >
                                            Preview
                                        </Link>
                                        <button
                                            className="btn btn-secondary"
                                            style={{ marginRight: "5px" }}
                                            onClick={this.updatePage}
                                        >
                                            Save Draft
                                        </button>
                                        <button className="btn btn-primary">
                                            Publish
                                        </button>
                                    </div>
                                </div>
                                <div
                                    style={{
                                        boxShadow: "0 1px 1px rgba(0,0,0,.04)",
                                        border: "1px solid #e5e5e5",
                                        background: "#fff",
                                        marginBottom: "20px"
                                    }}
                                >
                                    <div
                                        style={{
                                            borderBottom: "1px solid #eee",
                                            padding: "10px",
                                            fontSize: " 1.5em"
                                        }}
                                    >
                                        Featured Image
                                    </div>
                                    <div style={{ padding: "10px" }}>
                                        {!this.state.page.image && (
                                            <i>No featured image</i>
                                        )}
                                        {this.state.page.image && (
                                            <img
                                                src={
                                                    "http://127.0.0.1:8000/storage/uploads/" +
                                                    this.state.page.image
                                                        .filename +
                                                    "." +
                                                    this.state.page.image
                                                        .extension
                                                }
                                                className="card-img-top"
                                                alt="..."
                                            />
                                        )}
                                    </div>
                                    <div
                                        style={{
                                            background: "#f5f5f5",
                                            borderTop: "1px solid #ddd",
                                            padding: "10px"
                                        }}
                                    >
                                        {!this.state.page.image && (
                                            <button
                                                className="btn btn-primary"
                                                onClick={this.openMediaModal}
                                            >
                                                Add
                                            </button>
                                        )}
                                        {this.state.page.image && (
                                            <button
                                                className="btn btn-primary"
                                                onClick={this.openMediaModal}
                                            >
                                                Change
                                            </button>
                                        )}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!this.state.loading && (
                            <Modal
                                isOpen={this.state.modalIsOpen}
                                onRequestClose={this.closeModal}
                                style={customStyles}
                                contentLabel="Example Modal"
                                className="post-modal"
                                overlayClassName="post-modal-overlay"
                            >
                                <h2>Revisions</h2>

                                <div
                                    style={{
                                        maxHeight: "600px",
                                        overflow: "auto"
                                    }}
                                >
                                    <div
                                        className="accordion"
                                        id="accordionExample"
                                    >
                                        {this.state.page.revisions
                                            .filter(obj => obj.key === "body")
                                            .map((revision, i) => {
                                                return (
                                                    <div className="card">
                                                        <div className="card-header">
                                                            <h2
                                                                className="mb-0"
                                                                style={{
                                                                    display:
                                                                        "flex",
                                                                    alignItems:
                                                                        "center",
                                                                    justifyContent:
                                                                        "space-between"
                                                                }}
                                                            >
                                                                <button
                                                                    className="btn btn-link"
                                                                    type="button"
                                                                    onClick={this.setOpenRevision.bind(
                                                                        null,
                                                                        i
                                                                    )}
                                                                >
                                                                    {
                                                                        revision.created_at
                                                                    }
                                                                </button>
                                                                <a
                                                                    style={{
                                                                        cursor:
                                                                            "pointer",
                                                                        fontSize:
                                                                            "0.4em",
                                                                        color:
                                                                            "#007bff",
                                                                        textDecoration:
                                                                            "underline"
                                                                    }}
                                                                >
                                                                    Restore
                                                                </a>
                                                            </h2>
                                                        </div>
                                                        <div
                                                            className={`collapse ${
                                                                this.state
                                                                    .revisionOpen ===
                                                                i
                                                                    ? "show"
                                                                    : ""
                                                            }`}
                                                        >
                                                            <div
                                                                className="card-body"
                                                                style={{
                                                                    display:
                                                                        "flex"
                                                                }}
                                                            >
                                                                <ReactDiffViewer
                                                                    oldValue={
                                                                        revision.old_value
                                                                    }
                                                                    newValue={
                                                                        revision.new_value
                                                                    }
                                                                    splitView={
                                                                        true
                                                                    }
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                );
                                            })}
                                    </div>
                                </div>
                                <div
                                    style={{
                                        textAlign: "end",
                                        marginTop: "1em",
                                        cursor: "pointer"
                                    }}
                                >
                                    <button onClick={this.closeModal}>
                                        close
                                    </button>
                                </div>
                            </Modal>
                        )}
                        <Modal
                            isOpen={this.state.mediaModalIsOpen}
                            onRequestClose={this.closeMediaModal}
                            style={customStyles}
                            contentLabel="Example Modal"
                            className="post-modal"
                            overlayClassName="post-modal-overlay"
                        >
                            <MediaLibrary
                                isPost
                                selectFeaturedImage={this.selectFeaturedImage}
                            />
                        </Modal>
                    </main>
                </div>
            </div>
        );
    }
}
