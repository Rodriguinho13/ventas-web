import Modal from "@/Components/Modal";
import { useState } from "react";
import { useForm } from "@inertiajs/react";
import CreateButton from "@/Components/CreateButton";
import { HiOutlinePencilAlt, HiX } from "react-icons/hi";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import PrimaryButton from "@/Components/PrimaryButton";
import SecondaryButton from "@/Components/SecondaryButton";
import InputError from "@/Components/InputError";

export default function Form({id=0, category = {}}){
    const [showModal, setShowModal] = useState(false);
    const {data, setData, post, put, errors, reset, clearErrors} = useForm({name:!category ? '': category.name, description: !category ? '':category.description});

    //funcion para abrir el modal cuando demos clic
    function OpenModal(){
        setShowModal(true);
    }

    //funcion para cerrar el modal cuando demos cancelar
    function CloseModal(e){
        e.preventDefault();
        setShowModal(false);
        clearErrors();
        reset();
    }

    const submitCategory = (e) =>{
        //e.preventDefault();
        console.log(data);

        if(id === 0){
            post(route('categories.store'), {
                onSuccess: (res) => {
                    console.log('OK', res);
                    //CloseModal();
                },
                onError: (error) => {
                    console.log('error', error)
                }
            })
        }
        else{
            console.log('update');
            put(route('categories.update', id), {
                onSuccess: (res) => {
                    console.log('OK', res);
                    CloseModal();
                },
            })
        }
    }
    return(
        <div>
            <div>
                { id === 0 ? (
                    <CreateButton onClick={OpenModal} className="bg-blue-500">Crear nueva Categoria</CreateButton>
                ): (
                    <button onClick={OpenModal}><HiOutlinePencilAlt className="w-6 h-6"/></button>
                )}
            </div>
            <Modal show={showModal} closeable={true} onClose={setShowModal}>
                <div className="p-4">
                    <div className="flex justify-between pb-4">
                        <h1 className="font-semibold">CREAR NUEVA CATEGORIA</h1>
                        <button type="button" onClick={CloseModal} className="bg-gray-300 hover:bg-gray-400 px-2"><HiX/></button>
                    </div>
                    <form>
                        <InputLabel value="Nombre categoria"/>
                        {/* <label>Nombre de la Categoria</label> */}
                        <TextInput className="block w-full mb-2" type="text" name="name" value={data.name} onChange={(e) => setData('name', e.target.value)}/>
                        {/* <input type="text" name="name" value={data.name} onChange={(e) => setData('name', e.target.value)} /> */}
                        {errors.name && (
                            <InputError message={errors.name}></InputError>
                        )}
                        <InputLabel value="Descripcion categoria"/>
                        {/* <label>Descripcion de la Categoria</label> */}
                        <TextInput className="block w-full mb-2" type="text" name="description" value={data.description} onChange={(e) => setData('description', e.target.value)}/>

                        <div className="space-x-2 flex justify-end">
                            <SecondaryButton type="button" onClick={CloseModal}>Cancelar</SecondaryButton>
                            <PrimaryButton type="button" onClick={submitCategory}>Guardar</PrimaryButton>
                            {/* <button onClick={CloseModal}>Cancelar</button>
                            <button onClick={submitCategory}>Guardar</button> */}
                        </div>
                    </form>
                </div>
            </Modal>
        </div>
    )
}
