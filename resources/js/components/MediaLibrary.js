import React, { Component, useMemo, useCallback } from 'react';
import Menu from './Menu';

import Modal from 'react-modal';
import { useDropzone } from 'react-dropzone';

import './style.scss';

const baseStyle = {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    padding: '70px',
    borderWidth: 2,
    borderRadius: 2,
    borderColor: '#eeeeee',
    borderStyle: 'dashed',
    backgroundColor: '#fafafa',
    color: '#bdbdbd',
    outline: 'none',
    transition: 'border .24s ease-in-out',
};

const activeStyle = {
    borderColor: '#2196f3',
};

const acceptStyle = {
    borderColor: '#00e676',
};

const rejectStyle = {
    borderColor: '#ff1744',
};

function StyledDropzone(props) {
    const onDrop = useCallback(acceptedFiles => {
        props.setFiles(acceptedFiles);
    }, []);

    const {
        getRootProps,
        getInputProps,
        isDragActive,
        isDragAccept,
        isDragReject,
        acceptedFiles,
    } = useDropzone({ accept: 'image/*', onDrop });

    const style = useMemo(
        () => ({
            ...baseStyle,
            ...(isDragActive ? activeStyle : {}),
            ...(isDragAccept ? acceptStyle : {}),
            ...(isDragReject ? rejectStyle : {}),
        }),
        [isDragActive, isDragReject]
    );

    const files = props.files.map(file => (
        <li key={file.path}>
            {file.path} - {file.size} bytes
        </li>
    ));

    return (
        <section className="container">
            <div {...getRootProps({ style })}>
                <input {...getInputProps()} />
                <p>Drag 'n' drop some files here, or click to select files</p>
            </div>
            <aside style={{ marginTop: '10px' }}>
                <h4>Files</h4>
                <ul>{files}</ul>
            </aside>
        </section>
    );
}

export default class MediaLibrary extends Component {
    constructor(props) {
        super(props);
        this.state = {
            media: [],
            loading: true,
            addModalIsOpen: false,
            previewModalIsOpen: false,
            openMedia: {},
            newFiles: [],
        };

        this.getMedia = this.getMedia.bind(this);
        this.createMedia = this.createMedia.bind(this);
        this.openAddModal = this.openAddModal.bind(this);
        this.closeAddModal = this.closeAddModal.bind(this);
        this.openPreviewModal = this.openPreviewModal.bind(this);
        this.closePreviewModal = this.closePreviewModal.bind(this);
        this.setFiles = this.setFiles.bind(this);
        this.setOpenMedia = this.setOpenMedia.bind(this);
        this.unsetOpenMedia = this.unsetOpenMedia.bind(this);
        this.selectMediaForPost = this.selectMediaForPost.bind(this);
    }

    componentDidMount() {
        this.getMedia();
    }

    getMedia() {
        axios.get('/api/media').then(response => {
            this.setState({
                media: response.data,
                loading: false,
            });
        });
    }

    createMedia() {
        let formData = new FormData();
        this.state.newFiles.forEach((file, i) => {
            formData.append('files[]', this.state.newFiles[i], file.name);
        });

        axios.post('/api/media', formData).then(response => {
            this.setState({
                newFiles: [],
                addModalIsOpen: false,
            });
            this.getMedia();
        });
    }

    openAddModal() {
        this.setState({
            addModalIsOpen: true,
        });
    }

    closeAddModal() {
        this.setState({
            addModalIsOpen: false,
        });
    }

    openPreviewModal() {
        this.setState({
            previewModalIsOpen: true,
        });
    }

    closePreviewModal() {
        this.setState({
            previewModalIsOpen: false,
        });
    }

    setOpenMedia(id) {
        this.setState({
            openMedia: this.state.media.filter(m => m.id === id)[0],
        });
    }

    unsetOpenMedia() {
        this.setState({
            openMedia: 0,
        });
    }

    setFiles(files) {
        this.setState({
            newFiles: this.state.newFiles.concat(files),
        });
    }

    selectMediaForPost(media) {
        this.props.selectFeaturedImage(media);
    }

    render() {
        const customStyles = {
            content: {
                top: '50%',
                left: '50%',
                right: 'auto',
                bottom: 'auto',
                marginRight: '-50%',
                transform: 'translate(-50%, -50%)',
            },
        };

        let containerClass = 'col-md-9 ml-sm-auto col-lg-10 px-4';
        if (this.props.isPost) {
            containerClass = 'col-md-12 ml-sm-auto col-lg-12 px-4';
        }

        console.log(this.state);
        return (
            <div className="container-fluid">
                <div className="row">
                    {!this.props.isPost && <Menu />}
                    <main
                        role="main"
                        className={containerClass}
                        style={{
                            paddingTop: !this.props.isPost ? '75px' : '0',
                        }}
                    >
                        <h1>Media Library</h1>
                        <div
                            style={{ textAlign: 'right', marginBottom: '20px' }}
                        >
                            <button
                                className="btn btn-primary"
                                onClick={this.openAddModal}
                            >
                                Add Media
                            </button>
                        </div>
                        {this.state.media.length === 0 && (
                            <div>No media found</div>
                        )}
                        {this.state.media.length > 0 && (
                            <div
                                style={{
                                    display: 'flex',
                                    flexDirection: 'row',
                                    flexWrap: 'wrap',
                                }}
                            >
                                {!this.state.loading &&
                                    this.state.media.map((m, i) => {
                                        return (
                                            <div
                                                className="card"
                                                style={{
                                                    width:
                                                        'calc(100% * 1/4 - 20px)',
                                                    margin: '10px 10px',
                                                }}
                                                key={i}
                                            >
                                                <img
                                                    src={
                                                        'http://127.0.0.1:8000/storage/uploads/' +
                                                        m.filename +
                                                        '.' +
                                                        m.extension
                                                    }
                                                    className="card-img-top"
                                                    alt="..."
                                                />
                                                <div
                                                    className="card-body"
                                                    style={{
                                                        padding: '10px',
                                                        display: 'flex',
                                                        justifyContent:
                                                            'space-between',
                                                    }}
                                                >
                                                    <div>
                                                        {m.filename +
                                                            '.' +
                                                            m.extension}
                                                    </div>
                                                    <div>
                                                        {!this.props.isPost && (
                                                            <>
                                                                <button
                                                                    className="btn btn-primary btn-sm"
                                                                    style={{
                                                                        marginRight:
                                                                            '5px',
                                                                    }}
                                                                    onClick={() => {
                                                                        this.setOpenMedia(
                                                                            m.id
                                                                        );
                                                                        this.openPreviewModal();
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
                                                                <button className="btn btn-danger btn-sm">
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
                                                            </>
                                                        )}
                                                        {this.props.isPost && (
                                                            <>
                                                                <button
                                                                    className="btn btn-success btn-sm"
                                                                    onClick={this.selectMediaForPost.bind(
                                                                        null,
                                                                        m
                                                                    )}
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
                                                                        className="feather feather-check"
                                                                    >
                                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                                    </svg>
                                                                </button>
                                                            </>
                                                        )}
                                                    </div>
                                                </div>
                                            </div>
                                        );
                                    })}
                            </div>
                        )}
                        <Modal
                            isOpen={this.state.addModalIsOpen}
                            onRequestClose={this.closeAddModal}
                            style={customStyles}
                            contentLabel="Example Modal"
                            className="post-modal"
                            overlayClassName="post-modal-overlay"
                        >
                            <StyledDropzone
                                setFiles={this.setFiles}
                                files={this.state.newFiles}
                            />
                            <div
                                style={{ textAlign: 'right' }}
                                onClick={this.createMedia}
                            >
                                <button className="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </Modal>
                        <Modal
                            isOpen={this.state.previewModalIsOpen}
                            onRequestClose={this.closeAddModal}
                            style={customStyles}
                            contentLabel="Example Modal"
                            className="media-modal"
                            overlayClassName="post-modal-overlay"
                        >
                            <div style={{ display: 'flex' }}>
                                <div
                                    style={{
                                        width: '70%',
                                        backgroundColor: '#656565',
                                        display: 'flex',
                                        justifyContent: 'center',
                                        alignItems: 'center',
                                    }}
                                >
                                    <div>
                                        <img
                                            src={
                                                'http://127.0.0.1:8000/storage/uploads/' +
                                                this.state.openMedia.filename +
                                                '.' +
                                                this.state.openMedia.extension
                                            }
                                            style={{ width: '100%' }}
                                        />
                                    </div>
                                </div>
                                <div
                                    style={{
                                        background: '#f3f3f3',
                                        width: '30%',
                                        padding: '10px 20px',
                                    }}
                                >
                                    <div>
                                        Filename:{' '}
                                        {this.state.openMedia.filename +
                                            '.' +
                                            this.state.openMedia.extension}
                                    </div>
                                    <div>
                                        Mime Type:{' '}
                                        {this.state.openMedia.mime_type}
                                    </div>
                                    <div>Disk: {this.state.openMedia.disk}</div>
                                    <div>
                                        Upload Directory:{' '}
                                        {this.state.openMedia.directory}
                                    </div>
                                    <div>
                                        File Size:{' '}
                                        {this.state.openMedia.size / 1000} KB
                                    </div>
                                    <hr />
                                    <div>
                                        <form>
                                            <div className="form-group">
                                                <label htmlFor="title">
                                                    URL
                                                </label>
                                                <input
                                                    id="title"
                                                    className="form-control form-control-sm"
                                                    value={
                                                        'http://127.0.0.1:8000/storage/uploads/' +
                                                        this.state.openMedia
                                                            .filename +
                                                        '.' +
                                                        this.state.openMedia
                                                            .extension
                                                    }
                                                />
                                            </div>
                                            <div className="form-group">
                                                <label htmlFor="alt">
                                                    Alt Text
                                                </label>
                                                <input
                                                    id="alt"
                                                    className="form-control form-control-sm"
                                                    value=""
                                                />
                                            </div>
                                            <div className="form-group">
                                                <label htmlFor="caption">
                                                    Caption
                                                </label>
                                                <textarea
                                                    id="caption"
                                                    className="form-control form-control-sm"
                                                ></textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div
                                style={{
                                    textAlign: 'right',
                                    marginTop: '20px',
                                }}
                            >
                                <button
                                    className="btn btn-secondary"
                                    onClick={this.closePreviewModal}
                                >
                                    Close
                                </button>
                            </div>
                        </Modal>
                    </main>
                </div>
            </div>
        );
    }
}
