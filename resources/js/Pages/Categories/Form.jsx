import Modal from "@/Components/Modal";
import { useState } from "react";
import { useForm } from "@inertiajs/react";
import CreateButton from "@/Components/CreateButton";
import { HiMiniPencilSquare, HiXMark } from "react-icons/hi2";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import PrimaryButton from "@/Components/PrimaryButton";
import SecondaryButton from "@/Components/SecondaryButton";
import InputError from "@/Components/InputError";


export default function Form ({id = 0, category = {}}) {
    const [showModal, setShowModal] = useState(false);
    const {data, setData, post, put, errors, reset, clearErrors} = useForm({name: !category ? '': category.name, description: !category ? '': category.description});

    function OpenModal(){
        setShowModal(true);
    }

    function CloseModal(e){//para cerrar el modal en Cancelar
        e.preventDefault();//para que no se actualice la pagina
        setShowModal(false);
        clearErrors();
        reset();
    }

    const submitCategory = (e) =>{
        e.preventDefault();//para que no se actualice la pagina
        console.log(data);
        if(id === 0){
            //////para que la información del formulario se guarde en la BD//////
            post(route('categories.store'), {
                onSuccess: (res) => {
                console.log('OK', res);
                CloseModal();
                },
                onError: (error) => console.log('error', error)
            })
        }
        else{
            console.log('update');
            put(route('categories.update', id), {
                onSuccess: (res) => {
                console.log('OK', res);
                CloseModal();
                },
                onError: (error) => console.log('error', error)
            })
        }
    }

    return (
        <div>
            <div>
                { id === 0 ? (
                    <CreateButton type='button' onClick={OpenModal} >Crear nueva Categoria</CreateButton>
                    //<button onClick={OpenModal} className="bg-blue-500">Crear nueva Categoria</button>
                ): (
                    <button onClick={OpenModal}><HiMiniPencilSquare className="w-6 h-6" /></button>
                )}
            </div>
            <Modal show={showModal} closeable={true} onClose={CloseModal}>
                <div className="p-4">
                    <div className="flex justify-between pb-4">
                        <h1 className="font-semibold">CREAR NUEVA CATEGORIA</h1>
                        <button type="button" onClick={CloseModal} className="bg-gray-200 hover:bg-gray-400 px-2"><HiXMark /></button>
                    </div>
                    <form>
                        <InputLabel value="Nombre categoria"/>
                        <TextInput className="block w-full mb-2" type="text" name="name" value={data.name} onChange={(e) => setData('name', e.target.value)}/>
                        {errors.name && (
                            <InputError message={errors.name}></InputError>
                        )}

                        <InputLabel value="Descripción categoria"/>
                        <TextInput className="block w-full mb-2" type="text" name="description" value={data.description} onChange={(e) => setData('description', e.target.value)}/>

                        <div className="space-x-2 flex justify-end">
                            <SecondaryButton type="button" onClick={CloseModal}>Cancelar</SecondaryButton>
                            
                            <PrimaryButton type="button" onClick={submitCategory}>Guardar</PrimaryButton>
                        </div>

                    </form>
                </div>
            </Modal>
        </div>
    )
}
